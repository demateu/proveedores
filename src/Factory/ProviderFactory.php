<?php

namespace App\Factory;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Provider>
 *
 * @method        Provider|Proxy create(array|callable $attributes = [])
 * @method static Provider|Proxy createOne(array $attributes = [])
 * @method static Provider|Proxy find(object|array|mixed $criteria)
 * @method static Provider|Proxy findOrCreate(array $attributes)
 * @method static Provider|Proxy first(string $sortedField = 'id')
 * @method static Provider|Proxy last(string $sortedField = 'id')
 * @method static Provider|Proxy random(array $attributes = [])
 * @method static Provider|Proxy randomOrCreate(array $attributes = [])
 * @method static ProviderRepository|RepositoryProxy repository()
 * @method static Provider[]|Proxy[] all()
 * @method static Provider[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Provider[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Provider[]|Proxy[] findBy(array $attributes)
 * @method static Provider[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Provider[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ProviderFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->unique()->safeEmail(),
            'estado' => self::faker()->boolean(),
            'nombre' => self::faker()->firstName(),
            'telefono' => self::faker()->numberBetween(600000000, 699999999),
            'tipo' => self::faker()->randomElement(['hotel', 'pista','complemento']),
            'created_at' => self::faker()->dateTime(),
            //'updated_at' => null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Provider $provider): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Provider::class;
    }

}
