<?php


namespace App\Services;


use App\Exception\AlgorithmNotFoundException;
use App\Services\HashStrategies\AbstractHashStrategy;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class HashServiceCompiler
 * @package App\Services
 */
class HashServiceCompiler implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @throws AlgorithmNotFoundException
     */
    public function process(ContainerBuilder $container)
    {
        $contextDefinition = $container->findDefinition(HashService::class);
        $hashAlgorithm = $container->getParameter('hashAlgorithm');

        $taggedStrategies = $container->findTaggedServiceIds('hash_strategy');
        $hashClassName = AbstractHashStrategy::getNamespace() . ucfirst($hashAlgorithm) . 'HashStrategy';

        if (!isset($taggedStrategies[$hashClassName])) {
            throw new AlgorithmNotFoundException('Hash class name not found: ' . $hashClassName);
        }

        $contextDefinition->addMethodCall(
            'setCurrentHashStrategy',
            array(new Reference($hashClassName))
        );
    }
}