<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::insert([
            [
                'id' => 'PRO-24-001',
                'company_id' => 1,
                'date' => '2024-01-01',
                'name' => 'Project A',
                'billing' => '50000000',
                'cost_estimate' => '40000000',
                'margin' => '10000000',
                'percent' => '20%',
                'status_cost_progress' => '50%',
                'file' => 'file_project_a.pdf',
                'status' => Project::PENDING,
                'user_id' => 1,
            ],
            // Tambahkan data lainnya (9 data lagi)
            [
                'id' => 'PRO-24-002',
                'company_id' => 2,
                'date' => '2024-02-01',
                'name' => 'Project B',
                'billing' => '60000000',
                'cost_estimate' => '45000000',
                'margin' => '15000000',
                'percent' => '25%',
                'status_cost_progress' => '40%',
                'file' => 'file_project_b.pdf',
                'status' => Project::PENDING,
                'user_id' => 1,
            ],
            // Tambahkan data lainnya hingga 10 data.
        ]);
    }
}
