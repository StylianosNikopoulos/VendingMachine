<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserControllerUnitTest extends TestCase
{
    use RefreshDatabase;

    protected $controller;

    //Parent function so other functions can inherit from it
    protected function setUp(): void{
        parent::setUp();
        $this->controller = new UserController(); 
    }
    //Test calculateChange function to check if calculation is correct
    /** @test */
    public function it_calculates_change_correctly(){
        // Test various amounts
        $this->assertEquals([100, 50], $this->controller->calculateChange(150));
        $this->assertEquals([], $this->controller->calculateChange(0));
        $this->assertEquals([5], $this->controller->calculateChange(5));
        $this->assertEquals([100, 100, 5], $this->controller->calculateChange(205));
        $this->assertEquals([50, 5], $this->controller->calculateChange(55));
    
    }

}
