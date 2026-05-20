<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermSkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [

            /* ---------- Soft Skills ---------- */
            'Communication',
            'Leadership',
            'Teamwork',
            'Problem Solving',
            'Critical Thinking',
            'Time Management',
            'Decision Making',
            'Adaptability',
            'Creativity',
            'Negotiation',
            'Presentation',
            'Public Speaking',
            'Customer Service',

            /* ---------- Business Skills ---------- */
            'Sales',
            'Marketing',
            'Business Analysis',
            'Financial Management',
            'Accounting',
            'Human Resources',
            'Recruitment',
            'Training',
            'Project Management',

            /* ---------- Creative Skills ---------- */
            'Content Creation',
            'Graphic Design',
            'UI/UX Design',
            'Video Editing',
            'Photography',
            'SEO',
            'Social Media Management',
            'Writing',
            'Editing',

            /* ---------- Development Skills ---------- */
            'Web Development',
            'Frontend Development',
            'Backend Development',
            'Full Stack Development',
            'Mobile App Development',

            /* ---------- Programming Languages ---------- */
            'PHP',
            'Laravel',
            'JavaScript',
            'TypeScript',
            'React',
            'Next.js',
            'Vue.js',
            'Node.js',
            'Python',
            'Java',
            'C#',

            /* ---------- Database & DevOps ---------- */
            'SQL',
            'MySQL',
            'MongoDB',
            'Docker',
            'Kubernetes',
            'Git',
            'Cloud Computing',
            'AWS',
            'Azure',

            /* ---------- Advanced Tech ---------- */
            'Cybersecurity',
            'Networking',
            'Machine Learning',
            'Artificial Intelligence',
            'Data Analysis',
            'Research',
        ];

        foreach ($skills as $index => $skill) {
            DB::table('terms')->updateOrInsert(
                [
                    'slug' => Str::slug($skill),
                    'group' => 'skills',
                ],
                [
                    'tenant_id' => 1,
                    'status' => 1,
                    'name' => $skill,
                    'module' => 'shared',
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
