<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int level
 * @property int id
 * @property string code
 * @property string name
 * @property string description
 * @property int parent_id
 * @property mixed subCategories
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class CategoryResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape([
        'level' => "int",
        'id' => "int",
        'code' => "string",
        'name' => "string",
        'description' => "string",
        'parent_id' => "int",
        'sub_categories' => "mixed",
        'created_at' => "\DateTime",
        'updated_at' => "\DateTime"
    ])]
    public function toArray($request): array
    {
        return [
            'level' => $this->level,
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
//            'sub_categories' => CategoryResource::collection($this->subCategories),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
