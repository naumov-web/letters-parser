<?php

namespace Tests\UseCase;

use App\UseCases\UseCaseFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class BaseUseCaseTest
 * @package Tests\UseCase
 */
abstract class BaseUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Use case factory instance
     * @var UseCaseFactory
     */
    protected UseCaseFactory $useCaseFactory;

    /**
     * Prepare before tests
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        $this->useCaseFactory = app()->make(UseCaseFactory::class);
        parent::setUp();
    }
}
