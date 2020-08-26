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
            "nickname" => "Fiddle-leaf Propagation 1",
            "common_name" => "Fiddle-leaf Fig",
            "latin_name" => "Ficus lyrata",
            "birthday" => "",
            "soil" => "Regular plant soil. Well draining.",
            "light" => "Bright indirect light to full sun",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ]);

        factory(Houseplant::class)->create([
            "nickname" => "Fiddle-leaf Propagation 2",
            "common_name" => "Fiddle-leaf Fig",
            "latin_name" => "Ficus lyrata",
            "birthday" => "",
            "soil" => "Regular plant soil. Well draining.",
            "light" => "Bright indirect light to full sun",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ]);

        $this->getJson('api/houseplants', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(["success" => true])
            ->assertJsonStructure(["houseplants" => [
                0 => [
                    "id",
                    "created_at",
                    "updated_at",
                    "nickname",
                    "common_name",
                    "latin_name",
                    "birthday",
                    "soil",
                    "light",
                    "recommended_care",
                ]
            ]]);
    }

    public function testCreate()
    {
        $houseplant = [
            "nickname" => "Fiddle-leaf Propagation 1",
            "common_name" => "Fiddle-leaf Fig",
            "latin_name" => "Ficus lyrata",
            "birthday" => "",
            "soil" => "Regular plant soil. Well draining.",
            "light" => "Bright indirect light to full sunn",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ];

        $this->postJson('api/houseplants', $houseplant, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "houseplant" => [
                    "name" => "Fiddle-leaf Propagation 1",
                    "name" => "Fiddle-leaf Fig",
                    "latin_name" => "Ficus lyrata",
                    "birthday" => "",
                    "soil" => "Regular plant soil. Well draining.",
                    "light" => "Bright indirect light to full sunn",
                    "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
                ],
                "message" => "Created successfully"
            ]);
    }
}
