<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getTakenAt()
 * @method boolean hasTakenAt()
 * @method getPk()
 * @method boolean hasPk()
 * @method getId()
 * @method boolean hasId()
 * @method getDeviceTimestamp()
 * @method boolean hasDeviceTimestamp()
 * @method getMediaType()
 * @method boolean hasMediaType()
 * @method getCode()
 * @method boolean hasCode()
 * @method getClientCacheKey()
 * @method boolean hasClientCacheKey()
 * @method getFilterType()
 * @method boolean hasFilterType()
 * @method getShouldRequestAds()
 * @method boolean hasShouldRequestAds()
 * @method User getUser()
 * @method boolean hasUser()
 * @method getCanViewerReshare()
 * @method boolean hasCanViewerReShare()
 * @method getCaptionIsEdited()
 * @method boolean hasCaptionIsEdited()
 * @method getLikeAndViewCountsDisabled()
 * @method boolean hasLikeAndViewCountsDisabled()
 * @method FundraiserTag getFundraiserTag()
 * @method boolean hasFundraiserTag()
 * @method getIsPaidPartnership()
 * @method boolean hasIsPaidPartnership()
 * @method getCommentLikesEnabled()
 * @method boolean hasCommentLikesEnabled()
 * @method getCommentThreadingEnabled()
 * @method boolean hasCommentThreadingEnabled()
 * @method getHasMoreComments()
 * @method boolean hasHasMoreComments()
 * @method getMaxNumVisiblePreviewComments()
 * @method boolean hasMaxNumVisiblePreviewComments()
 * @method getCanViewMorePreviewComments()
 * @method boolean hasCanViewMorePreviewComments()
 * @method getCommentCount()
 * @method boolean hasCommentCount()
 * @method getHideViewAllCommentEntrypoint()
 * @method boolean hasHideViewAllCommentEntrypoint()
 * @method getInlineComposerDisplayCondition()
 * @method boolean hasInlineComposerDisplayCondition()
 * @method getInlineComposerImpTriggerTime()
 * @method boolean hasInlineComposerImpTriggerTime()
 * @method ImageVersions2 getImageVersions2()
 * @method boolean hasImageVersions2()
 * @method VideoVersions[] getVideoVersions()
 * @method boolean hasVideoVersions()
 * @method int getOriginalWidth()
 * @method boolean hasOriginalWidth()
 * @method int getOriginalHeight()
 * @method boolean hasOriginalHeight()
 * @method getLikeCount()
 * @method boolean hasLikeCount()
 * @method getHasLiked()
 * @method boolean hasHasLiked()
 * @method getPhotoOfYou()
 * @method boolean hasPhotoOfYou()
 * @method getCanSeeInsightsAsBrand()
 * @method boolean hasCanSeeInsightsAsBrand()
 * @method Caption getCaption()
 * @method boolean hasCaption()
 * @method getCanViewerSave()
 * @method getOrganicTrackingToken()
 * @method getProductType()
 * @method getIsInProfileGrid()
 * @method getProfileGridControlEnabled()
 * @method getDeletedReason()
 * @method getIntegrityReviewDecision()
 * @method \IgApi\Model\CarouselMedia[] getCarouselMedia()
 * @method boolean hasCarouselMedia()
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
            'video_versions' => VideoVersions::class.'[]',
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
            'carousel_media' => CarouselMedia::class.'[]'
        ];
}
