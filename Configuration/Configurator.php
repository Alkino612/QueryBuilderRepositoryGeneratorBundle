<?php

namespace tbn\QueryBuilderRepositoryGeneratorBundle\Configuration;

/**
 *
 * @author Thomas BEAUJEAN
 *
 */
class Configurator
{
    const DEFAULT_REPOSITORY_EXTEND = '\\Doctrine\\ORM\\EntityRepository';
    protected $entityConfigurations = [];

    /**
     *
     * @param type $entityConfigurations
     * @param type $repositoryExtensions
     */
    public function __construct($entityConfigurations, $repositoryExtensions)
    {
        $this->entityConfigurations = $entityConfigurations;
        $this->repositoryExtensions = $repositoryExtensions;
    }

    /**
     *
     * @param string $entityName
     *
     * @return string The
     */
    public function getEntityDqlName($entityName)
    {
        if (isset($this->entityConfigurations[$entityName])) {
            $entityDqlName = $this->entityConfigurations[$entityName]['querybuilder_name'];
        } else {
            $pathParts = explode('\\', $entityName);
            $entityClassname = end($pathParts);

            $entityDqlName = lcfirst($entityClassname);
        }

        return $entityDqlName;
    }

    /**
     *
     * @param string $entityName
     *
     * @return string The extends repository
     */
    public function getExtendRepository($entityName)
    {
        if (isset($this->repositoryExtensions[$entityName])) {
            $extendRepository = $this->repositoryExtensions[$entityName]['extension_class'];
        } else {
            $extendRepository = static::DEFAULT_REPOSITORY_EXTEND;
        }

        return $extendRepository;
    }
}
