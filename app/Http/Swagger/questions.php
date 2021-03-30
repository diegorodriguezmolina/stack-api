<?php
/** @OA\Info(title="Stack API", version="0.1") */
/** @OA\Tag(name="questions") **/

/**
 * @OA\Get(
 *      path="/api/questions",
 *      summary="List of questions that tagged",
 *      description="List of questions that tagged",
 *      tags={"questions"},
 *      @OA\Parameter(
 *          required=true,
 *          name="tagged",
 *          in="query"
 *      ),
 *      @OA\Parameter(
 *          required=false,
 *          name="fromdate",
 *          in="query"
 *      ),
 *      @OA\Parameter(
 *          required=false,
 *          name="todate",
 *          in="query"
 *      ),
 *      @OA\Response(response=200, description="",
 *         @OA\MediaType(
 *            mediaType="application/json"
 *         )
 *      ),
 *      security={{"bearerAuth":{}}}
 *   )
 */
