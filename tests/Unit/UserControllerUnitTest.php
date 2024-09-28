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
        $this->artisan('migrate');

    }

    //Test calculateChange function if calculation is correct
    /** @test */
    public function testCalculateChange(){
        // Test various amounts
        $this->assertEquals([100, 50], $this->controller->calculateChange(150));
        $this->assertEquals([], $this->controller->calculateChange(0));
        $this->assertEquals([5], $this->controller->calculateChange(5));
        $this->assertEquals([100, 100, 5], $this->controller->calculateChange(205));
        $this->assertEquals([50, 5], $this->controller->calculateChange(55));
    }

    //Test deposit function if unauthenticated user can deposit cents
    public function test_unauthenticated_user_cannot_deposit(){
        $response = $this->post('/deposit', ['amount' => 10]);

        // Check that the unauthenticated user is redirected to the login page
        $response->assertStatus(302);  
        $response->assertRedirect('/login'); 
    }
    
    //Test buy function if unauthenticated user can buy product
    public function test_unauthenticated_user_cannot_buy()
    {
        $seller = User::factory()->create([
            'role' => 'seller',  
        ]);
    
        $product = Product::factory()->create([
            'cost' => 100, 
            'amountAvailable' => 10,  
            'productName' => 'A Product',
            'sellerId' => $seller->id,  
        ]);
    
        $response = $this->postJson('/api/buy', [
            'product_id' => $product->id,
            'amount' => 1,
        ]);
    
        $response->assertStatus(404);
    }
    
}
