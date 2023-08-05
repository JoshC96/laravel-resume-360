<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Certification\DestroyCertificationRequest;
use App\Http\Requests\Certification\StoreCertificationRequest;
use App\Http\Requests\Certification\UpdateCertificationRequest;
use App\Http\Requests\Licence\DestroyLicenceRequest;
use App\Http\Requests\Licence\StoreLicenceRequest;
use App\Http\Requests\Licence\UpdateLicenceRequest;
use App\Http\Requests\Publication\DestroyPublicationRequest;
use App\Http\Requests\Publication\StorePublicationRequest;
use App\Http\Requests\Publication\UpdatePublicationRequest;
use App\Http\Requests\Qualification\DestroyQualificationRequest;
use App\Http\Requests\Qualification\StoreQualificationRequest;
use App\Http\Requests\Qualification\UpdateQualificationRequest;
use App\Http\Requests\Referee\DestroyRefereeRequest;
use App\Http\Requests\Referee\StoreRefereeRequest;
use App\Http\Requests\Referee\UpdateRefereeRequest;
use App\Http\Requests\User\UserProfileRequest;
use App\Http\Requests\WorkExperience\DestroyWorkExperienceRequest;
use App\Http\Requests\WorkExperience\StoreWorkExperienceRequest;
use App\Http\Requests\WorkExperience\UpdateWorkExperienceRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;
use App\Models\UserCertification;
use App\Models\UserLicence;
use App\Models\UserPublication;
use App\Models\UserQualification;
use App\Models\UserReferee;
use App\Models\UserWorkExperience;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CertificationRepository;
use App\Repositories\LicenceRepository;
use App\Repositories\PublicationRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\RefereeRepository;
use App\Repositories\WorkExperienceRepository;

class UserController extends ApiController
{

    public function __construct(
        Request $request, 
        protected RefereeRepository $refereeRepository,
        protected QualificationRepository $qualificationRepository,
        protected WorkExperienceRepository $workExperienceRepository,
        protected CertificationRepository $certificationRepository,
        protected LicenceRepository $licenceRepository,
        protected PublicationRepository $publicationRepository,
    )
    {
        parent::__construct($request);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     */
    public function getProfile(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_USER_PROFILE => new UserProfileResource(Auth::user())
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve referees, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function updateBio(UserProfileRequest $request): JsonResponse
    {
        $validated = $request->validate([
            UserProfileRequest::REQUEST_BIO => 'string|nullable|max:1000'
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();
            $user->{User::FIELD_BIO} = $validated[UserProfileRequest::REQUEST_BIO];

            return $this->formatResponse([
                'status' => $user->save()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update user bio, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getReferees(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_REFEREES => Auth::user()->{User::RELATION_REFEREES}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve referees, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param StoreRefereeRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createReferee(StoreRefereeRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'referee' => $this->refereeRepository->createUserReferee($user, $data)  
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create referee, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserReferee $referee 
     * @param UpdateRefereeRequest $request 
     * @return JsonResponse 
     */
    public function updateReferee(UserReferee $referee, UpdateRefereeRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->refereeRepository->updateUserReferee($referee, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update referee, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserReferee $referee 
     * @param DestroyRefereeRequest $request 
     * @return JsonResponse 
     */
    public function deleteReferee(UserReferee $referee, DestroyRefereeRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $referee->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete referee, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getQualifications(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_QUALFICATIONS => Auth::user()->{User::RELATION_QUALIFICATIONS}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve qualifications, error code:' . $exception->getCode()
            ]);
        }

    }

    /**
     * @param StoreQualfiicationRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createQualification(StoreQualificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'qualification' => $this->qualificationRepository->createUserQualification($user, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create qualification, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserQualification $qualification 
     * @param UpdateRefereeRequest $request 
     * @return JsonResponse 
     */
    public function updateQualification(UserQualification $qualification, UpdateQualificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->qualificationRepository->updateUserQualification($qualification, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update qualification, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserQualification $qualification 
     * @param DestroyQualificationRequest $request 
     * @return JsonResponse 
     */
    public function deleteQualification(UserQualification $qualification, DestroyQualificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $qualification->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete qualification, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getWorkExperiences(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_WORK_EXPERIENCES => Auth::user()->{User::RELATION_WORK_EXPERIENCES}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve work expeirences, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param StoreWorkExperienceRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createWorkExperience(StoreWorkExperienceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'workExperience' => $this->workExperienceRepository->createUserWorkExperience($user, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create work experience, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserWorkExperience $workExperience 
     * @param UpdateWorkExperienceRequest $request 
     * @return JsonResponse 
     */
    public function updateWorkExperience(UserWorkExperience $workExperience, UpdateWorkExperienceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->workExperienceRepository->updateUserWorkExperience($workExperience, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update work experience, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserWorkExperience $workExperience 
     * @param DestroyWorkExperienceRequest $request 
     * @return JsonResponse 
     */
    public function deleteWorkExperience(UserWorkExperience $workExperience, DestroyWorkExperienceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $workExperience->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete work experience, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getCertifications(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_CERTIFICATIONS => Auth::user()->{User::RELATION_CERTIFICATIONS}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve work expeirences, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param StoreCertificationRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createCertification(StoreCertificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'certification' => $this->certificationRepository->createUserCertification($user, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create certification, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserCertification $workExperience 
     * @param UpdateCertificationRequest $request 
     * @return JsonResponse 
     */
    public function updateCertification(UserCertification $certification, UpdateCertificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->certificationRepository->updateUserCertification($certification, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update certification, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserCertification $certification 
     * @param DestroyCertificationRequest $request 
     * @return JsonResponse 
     */
    public function deleteCertification(UserCertification $certification, DestroyCertificationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $certification->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete certification, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getLicences(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_LICENCES => Auth::user()->{User::RELATION_LICENCES}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve licences, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param StoreLicenceRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createLicence(StoreLicenceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'licence' => $this->licenceRepository->createUserLicence($user, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create licence, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserLicence $licence 
     * @param UpdateLicenceRequest $request 
     * @return JsonResponse 
     */
    public function updateLicence(UserLicence $licence, UpdateLicenceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->licenceRepository->updateUserLicence($licence, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update licence, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserLicence $licence 
     * @param DestroyLicenceRequest $request 
     * @return JsonResponse 
     */
    public function deleteLicence(UserLicence $licence, DestroyLicenceRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $licence->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete licence, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getPublications(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                UserProfileRequest::REQUEST_PUBLICATIONS => Auth::user()->{User::RELATION_PUBLICATIONS}
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve publications, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param StorePublicationRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createPublication(StorePublicationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        try {
            return $this->formatResponse([
                'licence' => $this->publicationRepository->createUserPublication($user, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to create publication, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserPublication $publication 
     * @param UpdatePublicationRequest $request 
     * @return JsonResponse 
     */
    public function updatePublication(UserPublication $publication, UpdatePublicationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $this->publicationRepository->updateUserPublication($publication, $data)
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to update publication, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param UserLicence $publication 
     * @param DestroyPublicationRequest $request 
     * @return JsonResponse 
     */
    public function deletePublication(UserPublication $publication, DestroyPublicationRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        try {
            return $this->formatResponse([
                'status' => $publication->delete()
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to delete publication, error code:' . $exception->getCode()
            ]);
        }
    }

}