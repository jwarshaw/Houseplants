<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Houseplant;

class HouseplantTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        factory(Houseplant::class)->create([
            "name" => "Fiddle-leaf fig",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ]);

        factory(Houseplant::class)->create([
            "name" => "Chinese Dollar Plant",
            "recommended_care" => "Water frequently. Propagate often.",
        ]);

        $this->getJson("/api/houseplants", ["Accept" => "application/json"])
            ->assertStatus(200)
            ->assertJson(["success" => true])
            ->assertJsonStructure(["houseplants" => [
                0 => [
                    "id",
                    "created_at",
                    "updated_at",
                    "name",
                    "recommended_care",
                ]
            ]]);
    }

    public function testCreate()
    {
        $houseplant = [
            "name" => "Fiddle-leaf fig",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ];

        $this->postJson("/api/houseplants", $houseplant, ["Accept" => "application/json"])
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }
}
