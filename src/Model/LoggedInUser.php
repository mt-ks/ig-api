<?php


namespace IgApi\Model;

use EJM\MainMapper;


/**
 * @method getPk()
 * @method getUsername()
 * @method getFullName()
 * @method getIsPrivate()
 * @method getProfilePicUrl()
 * @method getProfilePicId()
 * @method getIsVerified()
 * @method getHasAnonymousProfilePicture()
 * @method getCanBoostPost()
 * @method getIsBusiness()
 * @method getAccountType()
 * @method getProfessionalConversionSuggestedAccountType()
 * @method getIsCallToActionEnabled()
 * @method getCanSeeOrganicInsights()
 * @method getShowInsightsTerms()
 * @method getTotalIgtvVideos()
 * @method getReelAutoArchive()
 * @method getHasPlacedOrders()
 * @method getAllowedCommenterType()
 * @method Nametag getNametag()
 * @method getIsUsingUnifiedInboxForDirect()
 * @method getInteropMessagingUserFbid()
 * @method getCanSeePrimaryCountryInSettings()
 * @method getFbidV2()
 * @method getAllowContactsSync()
 * @method getPhoneNumber()
 * @method getCountryCode()
 * @method getNationalNumber()
 */

class LoggedInUser extends MainMapper{
    const MAP =
        [
            'pk' => 'string',
            'username' => 'string',
            'full_name' => 'string',
            'is_private' => 'string',
            'profile_pic_url' => 'string',
            'profile_pic_id' => 'string',
            'is_verified' => 'string',
            'has_anonymous_profile_picture' => 'string',
            'can_boost_post' => 'string',
            'is_business' => 'string',
            'account_type' => 'string',
            'professional_conversion_suggested_account_type' => 'string',
            'is_call_to_action_enabled' => 'string',
            'can_see_organic_insights' => 'string',
            'show_insights_terms' => 'string',
            'total_igtv_videos' => 'string',
            'reel_auto_archive' => 'string',
            'has_placed_orders' => 'string',
            'allowed_commenter_type' => 'string',
            'nametag' => Nametag::class,
            'is_using_unified_inbox_for_direct' => 'string',
            'interop_messaging_user_fbid' => 'string',
            'can_see_primary_country_in_settings' => 'string',
            'account_badges' => 'AccountBadges',
            'fbid_v2' => 'string',
            'allow_contacts_sync' => 'string',
            'phone_number' => 'string',
            'country_code' => 'string',
            'national_number' => 'string',
        ];
}