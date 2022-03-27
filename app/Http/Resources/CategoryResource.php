<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int id
 * @property string code
 * @property string name
 * @property string description
 * @property DateTime created_at
 * @property DateTime updated_at
 * @property mixed subCategories
 */
class CategoryResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "int", 'code' => "string", 'name' => "string", 'description' => "string", 'sub_categories' => "", 'created_at' => "\DateTime", 'updated_at' => "\DateTime"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'sub_categories' => CategoryResource::collection($this->subCategories),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
