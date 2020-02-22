<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Services\SRO\Shard\CharService;
use App\Library\Services\SRO\Shard\InventoryService;
use App\Model\SRO\Account\BlockedUser;
use App\Model\SRO\Log\LoginHistoryLog;
use App\Model\SRO\Account\OnlineOfflineLog;
use App\Model\SRO\Account\Punishment;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\Model\SRO\Account\TbUser;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

/**
 * Class SilkroadController
 * @package App\Http\Controllers\Backend
 */
class SilkroadController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexSroUser()
    {
        return view('backend.silkroad.tbuser.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function sroUserDatatables()
    {
        return DataTables::of(TbUser::query())->make(true);
    }

    /**
     * @param $jid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sroUserEdit($jid)
    {
        $tbuser = TbUser::with('getShardUser')
            ->with('getPunishmentUser')
            ->with('getSkSilk')
            ->with('getIsBlockedUser')
            ->findOrFail($jid);
        return view('backend.silkroad.tbuser.edit', [
            'tbuser' => $tbuser
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexSroPlayer()
    {
        return view('backend.silkroad.chars.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function sroPlayerDatatables()
    {
        return DataTables::of(Char::query())->make(true);
    }

    /**
     * @param $char
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sroPlayerEdit($char)
    {
        $char = Char::findOrFail($char);
        $loggedInHistory = LoginHistoryLog::where('CharID', $char->CharID)->get();
        $tbUser = User::where('CharID', $char->CharID)->get()->first();

        return view('backend.silkroad.chars.edit', [
            'char' => $char,
            'loggedInHistory' => $loggedInHistory,
            'tbUser' => $tbUser->UserJID
        ]);
    }

    /**
     * @param $jid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sroUserSilkAdd($jid, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'silk' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        SkSilkBuyList::create([
            'UserJID' => $jid,
            'Silk_Type' => SkSilkBuyList::SilkTypeWeb,
            'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
            'Silk_Offset' => SkSilk::where('JID', $jid)->pluck('silk_own')->first(),
            'Silk_Remain' => SkSilk::where('JID', $jid)->pluck('silk_own')->first() + $request->get('silk'),
            'ID' => $jid,
            'BuyQuantity' => $request->get('silk'),
            'OrderNumber' => 0,
            'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'SlipPaper' => 'dunno',
            'IP' => $request->ip(),
            'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        SkSilk::where('JID', $jid)
            ->increment(
                'silk_own', $request->get('silk')
            );

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $jid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sroUserBlockAdd($jid, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'block' => 'required|date',
            'title' => 'required|min:1|max:512',
            'description' => 'required|min:1|max:1024',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $StrUserID = TbUser::where('JID', $jid)->pluck('StrUserID')->first();

        $serialNo = Punishment::create([
            'UserJID' => $jid,
            'Type' => $request->get('type'),
            'Executor' => 'Webinterface',
            'Shard' => 3,
            'CharInfo' => $StrUserID,
            'PosInfo' => ' ',
            'Guide' => $request->get('title'),
            'Description' => $request->get('description'),
            'RaiseTime' => Carbon::now()->format('Y-m-d H:i:s'),
            'BlockStartTime' => Carbon::now()->format('Y-m-d H:i:s'),
            'BlockEndTime' => Carbon::parse(
                $request->get('block')
            )->format('Y-m-d H:i:s'),
            'PunishTime' => Carbon::now()->format('Y-m-d H:i:s'),
            'Status' => 0
        ]);

        BlockedUser::create([
            'UserJID' => $jid,
            'UserID' => $StrUserID,
            'Type' => $request->get('type'),
            'SerialNo' => $serialNo->id,
            'timeBegin' => Carbon::now()->format('Y-m-d H:i:s'),
            'timeEnd' => Carbon::parse(
                $request->get('block')
            )->format('Y-m-d H:i:s'),
        ]);

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sroUserBlockDestory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialno' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Punishment::where('SerialNo', $request->get('serialno'))->delete();

        BlockedUser::where('SerialNo', $request->get('serialno'))->delete();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $charId
     * @param Request $request
     * @param CharService $charService
     * @param InventoryService $inventoryService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sroUnstuckChar(
        $charId,
        Request $request,
        CharService $charService,
        InventoryService $inventoryService
    )
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $getChar = Char::where('CharID', $charId)->firstOrFail();

        if($getChar->getCharOnlineOffline) {
            if($getChar->getCharOnlineOffline->status === OnlineOfflineLog::STATUS_LOGGED_IN)
            {
                return back()->with('error', trans('backend/notification.form-submit.still-logged-in'));
            } else if($getChar->getCharOnlineOffline->status === OnlineOfflineLog::STATUS_LOGGED_OUT)
            {
                $jobItem = $inventoryService->getInventorySlot($charId, 8);

                if($jobItem) {
                    return back()->with('error', trans('backend/notification.form-submit.error-job'));
                } else {
                    $charService->setCharUnstuckNewPosition($charId);
                    return back()->with('success', trans('backend/notification.form-submit.success'));
                }
            }
        } else {
            return back()->with('error', trans('backend/notification.form-submit.no-online-offline'));
        }
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
