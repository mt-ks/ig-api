<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getTakenAt()
 * @method getPk()
 * @method getId()
 * @method getDeviceTimestamp()
 * @method getMediaType()
 * @method getCode()
 * @method getClientCacheKey()
 * @method getFilterType()
 * @method getShouldRequestAds()
 * @method User getUser()
 * @method getCanViewerReshare()
 * @method getCaptionIsEdited()
 * @method getLikeAndViewCountsDisabled()
 * @method FundraiserTag getFundraiserTag()
 * @method getIsPaidPartnership()
 * @method getCommentLikesEnabled()
 * @method getCommentThreadingEnabled()
 * @method getHasMoreComments()
 * @method getMaxNumVisiblePreviewComments()
 * @method getCanViewMorePreviewComments()
 * @method getCommentCount()
 * @method getHideViewAllCommentEntrypoint()
 * @method getInlineComposerDisplayCondition()
 * @method getInlineComposerImpTriggerTime()
 * @method ImageVersions2 getImageVersions2()
 * @method getOriginalWidth()
 * @method getOriginalHeight()
 * @method getLikeCount()
 * @method getHasLiked()
 * @method getPhotoOfYou()
 * @method getCanSeeInsightsAsBrand()
 * @method Caption getCaption()
 * @method getCanViewerSave()
 * @method getOrganicTrackingToken()
 * @method getProductType()
 * @method getIsInProfileGrid()
 * @method getProfileGridControlEnabled()
 * @method getDeletedReason()
 * @method getIntegrityReviewDecision()
 */
class Item extends MainMapper
{

    public const MAP =
        [
            'taken_at' => 'string',
            'pk' => 'string',
            'id' => 'string',
            'device_timestamp' => 'string',
            'media_type' => 'string',
            'code' => 'string',
            'client_cache_key' => 'string',
            'filter_type' => 'string',
            'should_request_ads' => 'string',
            'user' => User::class,
            'can_viewer_reshare' => 'string',
            'caption_is_edited' => 'string',
            'like_and_view_counts_disabled' => 'string',
            'is_paid_partnership' => 'string',
            'comment_likes_enabled' => 'string',
            'comment_threading_enabled' => 'string',
            'has_more_comments' => 'string',
            'max_num_visible_preview_comments' => 'string',
            'can_view_more_preview_comments' => 'string',
            'comment_count' => 'string',
            'hide_view_all_comment_entrypoint' => 'string',
            'inline_composer_display_condition' => 'string',
            'inline_composer_imp_trigger_time' => 'string',
            'image_versions2' => ImageVersions2::class,
            'original_width' => 'string',
            'original_height' => 'string',
            'like_count' => 'string',
            'has_liked' => 'string',
            'photo_of_you' => 'string',
            'can_see_insights_as_brand' => 'string',
            'caption' => Caption::class,
            'can_viewer_save' => 'string',
            'organic_tracking_token' => 'string',
            'product_type' => 'string',
            'is_in_profile_grid' => 'string',
            'profile_grid_control_enabled' => 'string',
            'deleted_reason' => 'string',
            'integrity_review_decision' => 'string',
        ];
}
