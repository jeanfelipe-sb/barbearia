<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImgservicosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImgservicosTable Test Case
 */
class ImgservicosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImgservicosTable
     */
    public $Imgservicos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.imgservicos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Imgservicos') ? [] : ['className' => 'App\Model\Table\ImgservicosTable'];
        $this->Imgservicos = TableRegistry::get('Imgservicos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Imgservicos);

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
}
