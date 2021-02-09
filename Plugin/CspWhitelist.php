<?php

namespace CtiDigital\CspWhitelist\Plugin;

use CtiDigital\CspWhitelist\Helper\Configuration;
use Magento\Csp\Api\Data\PolicyInterface;
use Magento\Csp\Model\Collector\CspWhitelistXmlCollector;
use Magento\Framework\Config\DataInterface as ConfigReader;
use Magento\Csp\Model\Policy\FetchPolicy;
use Magento\Csp\Model\Policy\FetchPolicyFactory;

class CspWhitelist
{
    /** @var ConfigReader */
    private $configReader;

    /** @var Configuration */
    private $configuration;

    /** @var FetchPolicy */
    private $fetchPolicy;

    /**
     * @param ConfigReader $configReader
     * @param Configuration $configuration
     * @param FetchPolicyFactory $fetchPolicy
     */
    public function __construct(
        ConfigReader $configReader,
        Configuration $configuration,
        FetchPolicyFactory $fetchPolicy
    ) {
        $this->configReader = $configReader;
        $this->configuration = $configuration;
        $this->fetchPolicy = $fetchPolicy;
    }

    /**
     * @param CspWhitelistXmlCollector $subject
     * @param callable $proceed
     * @param PolicyInterface[] $defaultPolicies
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundCollect(
        CspWhitelistXmlCollector $subject,
        callable $proceed,
        array $defaultPolicies = []
    ): array {
        if (!$this->configuration->isEnabled()) {
            return $proceed($defaultPolicies);
        }
        $customPolicies = $this->configuration->getPolicies();
        $policies = $defaultPolicies;
        $config = $this->configReader->get(null);
        foreach ($config as $policyId => $values) {
            if (isset($customPolicies[$policyId])) {
                foreach ($customPolicies[$policyId] as $policy) {
                    $values['hosts'][] = $policy;
                }
            }

            $policies[] = $this->fetchPolicy->create([
                'id' => $policyId,
                'noneAllowed' => false,
                'hostSources' => $values['hosts'],
                'schemeSources' => [],
                'selfAllowed' => false,
                'inlineAllowed' => false,
                'evalAllowed' => false,
                'nonceValues' => [],
                'hashValues' => $values['hashes'],
                'dynamicAllowed' => false,
                'eventHandlersAllowed' => false
            ]);
        }

        return $policies;
    }
}
