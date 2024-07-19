<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\{
    SkillResource,
    SiteResource,
    WorkExperienceResource
};
use App\Repositories\{
    TextRepository,
    SiteRepository,
    SkillRepository,
    WorkExperienceRepository
};
use App\Services\CvService;

class GetProjectsAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected SkillRepository $skillRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) { }

    public function execute(): array
    {
        $details         = $this->textRepository->getByNames(["fullname", "intro", "location"]);
        $sites           = $this->siteRepository->getAll();
        $skills          = $this->skillRepository->getByNames(["Backend", "Frontend", "Frameworks", "Misc"]);
        $workExperiences = $this->workExperienceRepository->getAll();

        return [
            'profile' => [
                'details' => $details,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences)
        ];
    }
}