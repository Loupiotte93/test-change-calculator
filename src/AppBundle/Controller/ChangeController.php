<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Registry\CalculatorRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/automaton")
 */
class ChangeController extends Controller
{
    /** @var CalculatorRegistry */
    private $calculatorRegistry;

    public function __construct(CalculatorRegistry $calculatorRegistry)
    {
        $this->calculatorRegistry = $calculatorRegistry;
    }

    /**
     * @Route("/{model}/change/{amount}", name="api_get_change")
     */
    public function changeAction(string $model, int $amount): Response
    {
        $automaton = $this->calculatorRegistry->getCalculatorFor($model);
        if (!$automaton) {
            throw new NotFoundHttpException(sprintf('Model "%s" not implemented or not found', $model));
        }

        $change = $automaton->getChange($amount);
        if (!$change) {
            return new JsonResponse(null, 204);
        }

        return new JsonResponse($change);
    }
}
