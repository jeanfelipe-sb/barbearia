<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UploadsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UploadsComponent Test Case
 */
class UploadsComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UploadsComponent
     */
    public $Uploads;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Uploads = new UploadsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Uploads);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
