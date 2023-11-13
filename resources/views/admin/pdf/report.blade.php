
<!-- saved from url=(0054)file:///C:/Users/SM/OneDrive/Desktop/poc%20report.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <style>
        .pdf-heading {
            text-align: center;
            font-size: 13px;
        }
        table{
            border:solid 1px;
        }
        td{
            border:solid 1px;
            border-collapse: collapse;
        }
        .pdf-wrapper table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid gray;
            font-size: 12px;
        }

        .pdf-wrapper table table {
            border: 0;
        }

        .pdf-wrapper tr {
            vertical-align: middle;

        }

        .pdf-wrapper td {
            text-align: center;
            border-right: 1px solid gray;
            padding: 3px;
        }

        .pdf-wrapper td:last-child {
            border-right: 0;
        }

        .pdf-wrapper .text-align-left {
            text-align: start;
        }

        .w-25 {
            width: 25px;
        }

        @page {
            size: auto;
            margin: 30px 10px
        }
    </style>
</head>

<body>
    <div class="pdf-wrapper">
        <div class="pdf-heading">
            <div>Form-H</div>
            <div>(See Rule 9)</div>
            <div>Leave with wage book</div>
        </div>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-align-left">
                            <div>1. SI. No. in the Register of asdult/young Person</div>
                            <div>2. Date of Entry into Services</div>
                        </td>
                        <td colspan="4" class="text-align-left">
                            <div>{{$balance->emp_id}}</div>
                            <div>{{date("Y-m-d")}}</div>
                        </td>
                        <td colspan="2" class="text-align-left">
                            <div>3.Name of Person</div>
                            <div>4.Father's/Husand's Name</div>
                        </td>
                        <td colspan="4" class="text-align-left">
                            <div>{{$balance->name}}</div>
                            <div>--</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11">Part-I Earned Leave</td>
                        <td colspan="4">Part-II Sick/Accident Leave(with Pay)</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            No. Of days Worked
                            <table>
                                <tbody>
                                    <tr>
                                        <td>from</td>
                                        <td>To</td>
                                        <td>Total Days Worked</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>Leave Earned
                            <table>
                                <tbody><tr>
                                    <td>4</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td style="width:50px;">Leave at credit (including balance, if any on return from leave on last occasion)
                            <table>
                                <tbody><tr>
                                    <td>5</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td colspan="3">
                            Date of Leave Availed
                            <table>
                                <tbody>
                                    <tr>
                                        <td>From</td>
                                        <td>To</td>
                                        <td>No. of days</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width:50px;">Balance n return from leave
                            <table>
                                <tbody><tr>
                                    <td>9</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td style="width:50px;">Date which wages for leave paid and amount paid
                            <table>
                                <tbody><tr>
                                    <td>10</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td>Remarks
                            <table>
                                <tbody><tr>
                                    <td>11</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td>Year
                            <table>
                                <tbody><tr>
                                    <td>12</td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td colspan="2">
                            sick/Accident Leave
                            <table>
                                <tbody>
                                    <tr>
                                        <td>of credit</td>
                                        <td>Availed</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>14</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>

                        <td style="width:50px;">Balance at the end of he year
                            <table>
                                <tbody>
                                    <tr>
                                        <td>15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-align-left">Carry Forwarded From 2022</td>
                        <?php
                            $el_b = $balance->el??0;
                            $sl_b = $balance->sl??0;
                        ?>

                        <td>{{$el_b}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$sl_b}}</td>
                    </tr>
                    <?php 
                    
                    for($month = 1; $month <= 12; $month++){
                        $start_date = '01-'.$month.'-'.$balance->year;
                        $end_date = date('t-m-Y', strtotime("{$balance->year}-{$month}-01"));
                    ?>
                    <tr>
                        <td>{{$start_date}}</td>
                        <td>{{$end_date}}</td>
                        <td>{{date('t', strtotime("{$balance->year}-{$month}-01"))}}</td>
                        <td>1.25</td>
                        <td>{{($el_b = $el_b+1.25)}}</td>
                         <?php 
                                    $leaves = $availed->where('type','EL')->whereBetween('leave_date',[date('Y-m-d',strtotime($start_date)),date('Y-m-d',strtotime($end_date))])->all();
                                    $t_availed = collect($leaves)->sum('debit')??0;
                                    $el_b -= $t_availed;
                                ?>
                        <td>
                            @foreach($leaves as $leave)
                            {{date('d-m-Y',strtotime($leave->leave_date))}}<br/>
                            @endforeach
                        </td>
                        <td>
                            @foreach($leaves as $leave)
                            {{date('d-m-Y',strtotime($leave->leave_date))}}<br/>
                            @endforeach
                        </td>
                        <td>{{$t_availed}}</td>
                        <td>{{$el_b}}</td>
                        <td></td>
                        <td></td>
                        <td>{{$balance->year}}</td>
                        <td>1</td>
                        <td>
                            <?php 
                                $leaves = $availed->where('type','SL')->whereBetween('leave_date',[date('Y-m-d',strtotime($start_date)),date('Y-m-d',strtotime($end_date))])->all();
                                $t_availed = collect($leaves)->sum('debit')??0;
                                $sl_b += 1;
                                $sl_b -= $t_availed;
                            ?>
                            @foreach($leaves as $leave)
                                {{date('d-m-Y',strtotime($leave->leave_date))}}
                            @endforeach 
                        </td>
                        <td>{{$sl_b}}</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</body></html>