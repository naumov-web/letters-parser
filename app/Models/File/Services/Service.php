<?php

namespace App\Models\File\Services;

use App\Models\Base\DTO\CreateFileDTO;
use App\Models\Base\DTO\MorphDTO;
use App\Models\File\Contracts\IDatabaseRepository;
use App\Models\File\Contracts\IFileService;
use App\Models\File\DTO\FileDTO;
use Illuminate\Support\Facades\Storage;

/**
 * Class Service
 * @package App\Models\File\Services
 */
final class Service implements IFileService
{
    /**
     * Service constructor
     * @param IDatabaseRepository $repository
     */
    public function __construct(private IDatabaseRepository $repository) {}

    /**
     * @inheritDoc
     */
    public function create(MorphDTO $ownerDto, CreateFileDTO $createFileDto, int $semanticTypeId): string
    {
        $fileDto = new FileDTO();
        $fileDto->ownerId = $ownerDto->ownerId;
        $fileDto->ownerType = $ownerDto->ownerType;
        $fileDto->name = $createFileDto->name;
        $fileDto->mime = $createFileDto->mime;
        $fileDto->path = $this->storeFile($createFileDto);
        $fileDto->semanticTypeId = $semanticTypeId;

        $this->repository->create($fileDto);

        return $fileDto->path;
    }

    /**
     * Store file
     *
     * @param CreateFileDTO $createFileDto
     * @return string
     */
    private function storeFile(CreateFileDTO $createFileDto): string
    {
        $path = uniqid() . '-' . $createFileDto->name;
        Storage::disk()
            ->put(
                $path,
                base64_decode($createFileDto->content)
            );

        return $path;
    }
}
