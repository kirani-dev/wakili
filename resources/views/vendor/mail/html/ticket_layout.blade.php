<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
            background-color: #0a6edb;
        }
    }
    .small {
        font-size: 90%;
        font-weight: 400;
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                               role="presentation" style="margin-top: 50px !important;">
                            <!-- Body content -->
                            <tr>
                                <td class="header">
                                    <a href="" style="display: inline-block; float:left !important;">
                                        <img src="{{ asset('/theme/assets/images/Calltronix-Animation .gif') }}"
                                             class="logo" alt="Calltronix Logo" height="40">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="header1">
                                    <a href="" style="display: inline-block; float:left !important;">
                                        {{--@if (trim($slot) === 'Laravel')--}}
                                        {{--                                        <img src="{{ asset('/theme/assets/images/Calltronix-Animation .gif') }}" class="logo" alt="Calltronix Logo" height="40">--}}
                                        {{--@else--}}
                                        {{--{{ $slot }}--}}
                                        {{--@endif--}}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="content-cell">
                                    <table class="small" align="center" width="570" cellpadding="0" cellspacing="0"
                                           role="presentation">
                                        <tr>
                                            <td class="title small">
                                                Dear
                                                <b>{{ ($data['name'] == "System") ? $data['assigned_to'] : $data['name'] }}</b>
                                                <strong
                                                    style="color:#116fe2; float:right !important;">({{ $data['title_type'] }}
                                                    )</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        <tr>
                                            <td class="paragraph">
                                                {!! $data['message'] !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        @if(!$data['is_acknowledgement'])
                                            @if($ticket->user_id == request()->user()->id)
                                                <tr>
                                                    <td class="paragraph">
                                                        Please update the status of the pending ticket within the CRM to
                                                        avoid further escalation.
                                                        <hr>
                                                    </td>

                                                </tr>
                                            @endif
                                        @endif


                                        <tr>
                                            <td style="text-align: center;"><h4>Ticket Information</h4></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="small"
                                                    style="width:100%; border: 1px solid black;border-collapse: collapse;">
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Ticket Number:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">
                                                            CC{{ $ticket->id }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Ticket Status:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{ $ticket->status }}</td>
                                                    </tr>
                                                    {{--                <tr>--}}
                                                    {{--                    <th style=" padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">--}}
                                                    {{--                        Ticket Priority:--}}
                                                    {{--                    </th>--}}
                                                    {{--                    <td style=" padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{\App\Repositories\StatusRepository::getTicketPriority($ticket->priority)}}</td>--}}
                                                    {{--                </tr>--}}
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Department:
                                                        </th>
                                                        <td style="width:65% !important;   padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{$ticket->department}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Issue
                                                            Category:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{$ticket->issue_category}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Disposition:
                                                        </th>
                                                        <td style="width:65% !important;   padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{$ticket->disposition}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Line
                                                            Of Business:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{$ticket->LOB}}</td>
                                                    </tr>
                                                    @if($ticket->tat && @$ticket->tat > 0)
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Turn Around Time:
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! $data['time'] !!}</td>
                                                        </tr>
                                                    @endif

                                                    @if($ticket->acknowledged_at)
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Acknowledged At:
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! \Carbon\Carbon::parse($ticket->acknowledged_at)->isoFormat('Do MMM Y')."  &nbsp;&nbsp;<small><b>(".\Carbon\Carbon::parse($ticket->acknowledged_at)->format('h:i:s A').")</b></small>" !!}</td>
                                                        </tr>
                                                    @endif
                                                    @if(@$ticket->expected_start_date)
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Expected Start Date:
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! \Carbon\Carbon::parse($ticket->expected_start_date)->isoFormat('Do MMM Y H:mm A') !!}</td>
                                                        </tr>
                                                    @endif
                                                    @if(isset($ticket->acknowledged_at) && isset($ticket->resolved_at))
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Resolved At
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! \Carbon\Carbon::parse($ticket->resolved_at)->isoFormat('Do MMM Y')."  &nbsp;&nbsp;<small><b>(".\Carbon\Carbon::parse($ticket->resolved_at)->format('h:i:s A').")</b></small>" !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Actual Resolution Time
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! getTimeDifferenceInDaysAndHours($ticket->acknowledged_at,$ticket->resolved_at) !!}</td>
                                                        </tr>
                                                    @endif
                                                    @if(isset($ticket->closed_at))
                                                        <tr>
                                                            <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                                Closed At
                                                            </th>
                                                            <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! \Carbon\Carbon::parse($ticket->closed_at)->isoFormat('Do MMM Y')."  &nbsp;&nbsp;<small><b>(".\Carbon\Carbon::parse($ticket->closed_at)->format('h:i:s A').")</b></small>" !!}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Age
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{!! getTicketAge($ticket->id) !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Description:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">   {!! $data['description'] !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Ticket Assigned To :
                                                        </th>
                                                        <td style="width:65% !important;   padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{$data['assigned_to']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Ticket Created By:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;">{{ (@$ticket->created_by) ? $ticket->created_by : "System" }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:35% !important;   padding: 5px;text-align: right;border: 1px solid black;border-collapse: collapse;">
                                                            Ticket Created At:
                                                        </th>
                                                        <td style="width:65% !important;  padding: 5px;text-align: left;border: 1px solid black;border-collapse: collapse;"> {!! \Carbon\Carbon::parse($ticket->created_at)->isoFormat('Do MMM Y')."  &nbsp;&nbsp;<small><b>(".\Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d h:i:s A').")</b></small>" !!}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td style="border-left: 2px">

                                                <h5 class="secondary"><strong>Last Comments</strong></h5>
                                                <ul class="small" style="border-left: solid; border-left-color: #85bdad; ">
                                                    @foreach($ticket->TicketUpdates->take(10) as $key=> $ticket_update)
                                                        <li>
                                                            {!! $ticket_update->comment !!}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="action" align="center" width="100%" cellpadding="0"
                                                       cellspacing="0" role="presentation">
                                                    <tr>
                                                        <td align="center">
                                                            <table width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0" role="presentation">
                                                                <tr>
                                                                    <td align="center">
                                                                        <table class="small" border="0" cellpadding="0"
                                                                               cellspacing="0" role="presentation">
                                                                            <tr>
                                                                                <td>
                                                                                    <?php $color = "orange" ?>
                                                                                    <a href="{{ $data['link'] }}"
                                                                                       class="button button-{{ $color ?? '' }}"
                                                                                       target="_blank" rel="noopener">View
                                                                                        Ticket</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-cell">

                                                {{ Illuminate\Mail\Markdown::parse($slot) }}

                                                {{ $subcopy ?? '' }}
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

                {{ $footer ?? '' }}
            </table>
        </td>
    </tr>
</table>
</body>
</html>
