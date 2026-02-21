<?php
namespace Modules\Attendance\Support;
use Modules\Shared\Support\BaseActions;

class Actions extends BaseActions
{
    public const TODAY		= 'today';
    public const MARK		= 'mark';
    public const CORRECT	= 'correct';
    public const DAILY		= 'daily';
    public const MONTHLY	= 'monthly';
    public const ENTITY		= 'entity';
    public const ANALYSIS	= 'analysis';
    public const QR			= 'qr';
    public const BIOMETRIC	= 'biometric';
    public const RFID		= 'rfid';
    public const SELF		= 'self';
    public const MANAGE		= 'manage';
    public const BASIC		= 'basic';
    public const PERMISSIONS = 'permissions';
}
