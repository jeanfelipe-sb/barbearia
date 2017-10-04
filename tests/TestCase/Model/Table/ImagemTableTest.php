<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImagemTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImagemTable Test Case
 */
class ImagemTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImagemTable
     */
    public $Imagem;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.imagem',
        'app.produto',
        'app.categoria'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Imagem') ? [] : ['className' => 'App\Model\Table\ImagemTable'];
        $this->Imagem = TableRegistry::get('Imagem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Imagem);

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
