<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Houseplant;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $houseplant = factory(Houseplant::class)->create([
            "name" => "Fiddle-leaf fig",
            "recommended_care" => "Allow soil to dry completely between watering. Water thoroughly but make sure soil is well draining. Use fiddle-leaf specific fertilizer. Rotate plant regularly",
        ]);

        $note = [
            "date" => "2020-08-26",
            "water_cups" => "2",
            "height_inches" => "12",
        ];

        $this->postJson("/api/houseplants/{$houseplant->id}/notes", $note, ["Accept" => "application/json"])
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }
}
