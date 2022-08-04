<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Paste
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $syntax
 * @property string|null $expiration
 * @property string|null $exposure
 * @property string $hash
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Paste newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paste newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paste query()
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereExposure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereSyntax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paste whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperPaste {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Paste[] $pastes
 * @property-read int|null $pastes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

