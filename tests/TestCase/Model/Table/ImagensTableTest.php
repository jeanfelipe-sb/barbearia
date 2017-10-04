<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImagensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImagensTable Test Case
 */
class ImagensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImagensTable
     */
    public $Imagens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.imagens',
        'app.produtos',
        'app.categorias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Imagens') ? [] : ['className' => 'App\Model\Table\ImagensTable'];
        $this->Imagens = TableRegistry::get('Imagens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Imagens);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
