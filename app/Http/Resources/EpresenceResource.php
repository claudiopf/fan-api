<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpresenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->type = 'IN') {
            $wktMasuk = Carbon::parse($this['waktu'])->translatedFormat('H:i:s');
        }
        if ($this->type = 'OUT') {
            $wktPulang = Carbon::parse($this['waktu'])->translatedFormat('H:i:s');
        }

        if ($this->is_approve = 'TRUE') {
            $stsMasuk = 'APPROVE';
        }
        if ($this->is_approve = 'FALSE') {
            $stsPulang = 'REJECT';
        }
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'tanggal' => Carbon::parse($this['waktu'])->translatedFormat('Y-M-d'),
            'waktu_masuk' => $wktMasuk,
            'waktu_pulang' => $wktPulang,
            'status_masuk' => $stsMasuk,
            'status_pulang' => $stsPulang
        ];
    }
}
