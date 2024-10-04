<?php

namespace App\Http\Resources\Project;

use App\Models\Project;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        foreach ($this as $key => $project) {
            $data[] = [
                'id' => $project->id,
                'client' => [
                    'id' => $project->company->id,
                    'name' => $project->company->name,
                    'contact_type' => $project->company->contactType->name,
                ],
                'date' => $project->date,
                'name' => $project->name,
                'billing' => $project->billing,
                'cost_estimate' => $project->cost_estimate,
                'margin' => $project->margin,
                'percent' => round($project->percent, 2),
                'file_attachment' => [
                    'name' => date('Y', strtotime($project->created_at)) . '/' . $project->id . '.' . pathinfo($project->file, PATHINFO_EXTENSION),
                    'link' => asset("storage/$project->file")
                ],
                'cost_progress' => $this->costProgress($project),
                'status' => $this->getStatus($project->status),
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ];

            if ($project->user) {
                $data[$key]['created_by'] = [
                    "id" => $project->user->id,
                    "name" => $project->user->name,
                ];
            }
        }

        return $data;
    }

    protected function getStatus($status)
    {
        $data = [
            "id" => $status,
            "name" => "Pending"
        ];

        if ($status == Project::ACTIVE) {
            return [
                "id" => $status,
                "name" => "Active"
            ];
        }

        if ($status == Project::REJECTED) {
            return [
                "id" => $status,
                "name" => "Rejected"
            ];
        }

        return $data;
    }

    protected function costProgress($project)
    {
        $status = Project::STATUS_OPEN;
        $total = 0;

        $purchases = $project->purchases()->where('tab', Purchase::TAB_PAID)->get();

        foreach ($purchases as $purchase) {
            $total += $purchase->sub_total;
        }

         // Cek apakah cost_estimate lebih besar dari nol sebelum melakukan pembagian
        if ($project->cost_estimate > 0) {
            $costEstimate = round(($total / $project->cost_estimate) * 100, 2);
        } else {
            // Jika cost_estimate bernilai nol, tentukan nilai default
            $costEstimate = 0;
        }
        
        if ($costEstimate > 90) {
            $status = Project::STATUS_NEED_TO_CHECK;
        }

        if ($costEstimate == 100) {
            $status = Project::STATUS_CLOSED;
        }

        // Simpan nilai status cost progress ke dalam model Project
        $project->update(['status_cost_progress' => $status]);

        return [
            'status_cost_progress' => $status,
            // 'status' => $status,
            'percent' => $costEstimate . '%',
            'real_cost' => $total
        ];
    }
}