<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id'  =>Project::factory(), // Tạo một dự án mới cho mỗi nhiệm vụ
            'task_name'   =>fake()->sentence(3),
            'description' =>fake()->paragraph(),
            'status'      =>fake()->randomElement(['Chưa bắt đầu', 'Đang thực hiện', 'Đã hoàn thành']),
        ];
    }
}
