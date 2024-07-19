<?php

namespace App\Services;

use App\Repositories\{
    TextRepository,
    SiteRepository,
    SkillRepository,
    WorkExperienceRepository
};

class CvService
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected SkillRepository $skillRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    public function getData()
    {
        $details         = $this->textRepository->getByNames(["fullname", "intro", "location"]);
        $sites           = $this->siteRepository->getAll();
        $skills          = $this->skillRepository->getByNames(["Backend", "Frontend", "Frameworks", "Misc"]);
        $workExperiences = $this->workExperienceRepository->getAll();

        return collect([
            'profile' => [
                'details' => $details,
                'sites'   => $sites
            ],
            'skill_groups'     => $skills,
            'work_experiences' => $workExperiences
        ]);
    }
}
