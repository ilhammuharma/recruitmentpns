<?
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) 
	{
		// last request was more than 30 minutes ago
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp	
	if(!isset($_SESSION['nama']))
	{ //header('location:'.$base_url.'index.php?r=fptk');
	}
	else
	{
		$user=mysql_fetch_array(mysql_query("select nama from loginuser where idLogin='".$_POST['pic']."'"));
		if($_POST['pic']==''){$usernama="Semua Recruiter";}else{$usernama=$user['nama'];}
		
		?>
			<style>
				.print tr td
				{
					padding:1px 0px;
					vertical-align: top;
				}
				.chartJS ul {
					display: inline;
				  list-style: none;
				  margin: 0;
				  padding: 0;
				  overflow: hidden;
				}
				.chartJS ul li {
				   display: inline;
				  padding-left: 30px;
				  position: relative;
				  margin-bottom: 4px;
				  border-radius: 5px;
				  padding: 2px 8px 2px 28px;
				  font-size: 12px;
				  margin-right:15px;
				  cursor: default;
				  -webkit-transition: background-color 200ms ease-in-out;
				  -moz-transition: background-color 200ms ease-in-out;
				  -o-transition: background-color 200ms ease-in-out;
				  transition: background-color 200ms ease-in-out;
				}
				.chartJS li span {
				  display: block;
				  position: absolute;
				  left: 0;
				  top: 0;
				  width: 20px;
				  height: 100%;
				  border-radius: 5px;
				}
			</style>
			<link rel="stylesheet" href="assets/print-invoice.css" media="print">
			<div class="page-head">
				<h3 class="m-b-less">SUMMARY REPORT</h3>
			</div>           
			<!--body wrapper start-->
			<div class="wrapper">
				<div class="row">
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading ">
								Summary Fullfillment Base on FPTK <?=$usernama;?>
								<span class="tools pull-right">
									<a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
								</span>
							</header>
							<div class="table-responsive" style="padding:15px;">
							<table class="table table-fullfill data-table table-striped custom-table table-hover">
								<thead>
									<tr bgcolor="#dedede">
										
										<th style="text-align:center;">Month</th>
										<th style="text-align:center;">Previous</th>
										<th style="text-align:center;">This Month</th>
										<th style="text-align:center;">Sum</th>
										<th style="text-align:center;">Fullfillment</th>
										<th style="text-align:center;">Disc</th>
										<th style="text-align:center;">%</th>
									</tr>
								</thead>
								<tbody>
									<?
									for($month = 1 ; $month <= 12; $month++){
									$print_month= date("F",mktime(0,0,0,$month,1,date("Y")));
									if($_POST['pic']==''){$pic="";}else{ $pic="and pic='".$_POST['pic']."'";}
									if($month==1){
									//prev
									$prev_year=mysql_fetch_array(mysql_query("select sum(jumlahlKualifikasi) as cowo, sum(jumlahpKualifikasi) as cewe from fptk where rejectFptk='' and namaDirektur!='' and year(tanggalDirektur)<'".$_POST['year']."' $pic"));
									//echo "select sum(jumlahlKualifikasi) as cowo, sum(jumlahpKualifikasi) as cewe from fptk where rejectFptk='' and namaDirektur!='' and closingBy='' and year(tanggalDirektur)<'".$_POST['year']."' and pic='".$_POST['pic']."'";
									$prev=$prev_year['cowo']+$prev_year['cewe'];
									}else{
									$prev_year=mysql_fetch_array(mysql_query("select sum(jumlahlKualifikasi) as cowo, sum(jumlahpKualifikasi) as cewe from fptk where rejectFptk='' and namaDirektur!='' and year(tanggalDirektur)='".$_POST['year']."' and month(tanggalDirektur)='".($month-1)."' $pic"));
									$prev=$aa[$month-1];
									}
									//$prev=$prev_year['cowo']+$prev_year['cewe'];
									//this month
									$thisaa=mysql_fetch_array(mysql_query("select sum(jumlahlKualifikasi) as cowo, sum(jumlahpKualifikasi) as cewe from fptk where rejectFptk='' and closingBy!='' and year(tanggalDirektur)='".$_POST['year']."' and month(tanggalDirektur)='".$month."'$pic"));
									$this_month=$thisaa['cowo']+$thisaa['cewe'];
									//tot fptk
									$tot=$prev+$this_month;
									//fill
									$fullfill=mysql_fetch_array(mysql_query("select sum(jumlahlKualifikasi) as cowo, sum(jumlahpKualifikasi) as cewe from fptk where rejectFptk='' and closingBy!='' and year(closingDate)='".$_POST['year']."' and month(closingDate)='".$month."' $pic"));
									$fill=$fullfill['cowo']+$fullfill['cewe'];
									//disc
									$disc=$tot-$fill;
									//persen
									if($tot!=0){
									$persen=($fill/$tot)*100;
									}else{$persen=0;}
									$total[$month]=$tot;
									$fullfillment[$month]=$fill;
									$selisih[$month]=$disc;
									$persentase[$month]=$persen;
									$aa[$month]=$disc;
									?>
											<tr>
												
												<td align="center"><?=$print_month;?></td>
												<td align="center"><?=$prev;?></td>
												<td align="center"><?=$this_month;?></td>
												<td align="center"><?=$tot;?></td>
												<td align="center"><?=$fill;?></td>
												<td align="center"><?=$disc;?></td>
												<td align="center"><?=number_format($persen,0);?>%</td>
											</tr>
											
									<? }  ?>
									
								</tbody>
							</table>
							</div>
						</section>
					</div>
					
					<div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Fullfillment Chart <?=$usernama;?>
                                <span class="tools pull-right">
                                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close fa fa-times" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="chartJS">
									
                                    <canvas id="bar-chart-js" height="350" width="100%" ></canvas>
									<center><div id="legend"></div></center>
                                </div>
                            </div>
                        </section>
                    </div>
					
				</div>
			</div>
			<!--body wrapper end-->
		<? 
	} 
?>
<script src="js/chart-js/chart.js"></script>
<script>

(function(){
    var t;
    function size(animate){
        if (animate == undefined){
            animate = false;
        }
        clearTimeout(t);
        t = setTimeout(function(){
            $("canvas").each(function(i,el){
                $(el).attr({
                    "width":$(el).parent().width(),
                    "height":$(el).parent().outerHeight()
                });
            });
            redraw(animate);
            var m = 0;
            $(".chartJS").height("");
            $(".chartJS").each(function(i,el){ m = Math.max(m,$(el).height()); });
            $(".chartJS").height(m);
        }, 30);
    }
    $(window).on('resize', function(){ size(false); });


    function redraw(animation){
        var options = {};
        if (!animation){
            options.animation = false;
        } else {
            options.animation = true;
        }
		var helpers = Chart.helpers;
		var canvas = document.getElementById('bar');
		var randomScalingFactor = function() {
		  return Math.round(Math.random() * 100)
		};

        var barChartData = {
            labels : [<?for($month = 1 ; $month <= 12; $month++){ echo"\"".date("F",mktime(0,0,0,$month,1,date("Y")))."\",";}?>],
			
            datasets : [
                {
					label: "Total FPTK",
                    fillColor : "#4EC9B4",
                    strokeColor : "#4EC9B4",
					
                    data : [<?for($month = 1 ; $month <= 12; $month++){ echo $total[$month].",";}?>]
                },
                {
                    fillColor : "#868BB8",
                    strokeColor : "#868BB8",
					label: "Fullfill",
                    data : [<?for($month = 1 ; $month <= 12; $month++){ echo $fullfillment[$month].",";}?>]
                },
                {
                    fillColor : "#ffbfef",
                    strokeColor : "#ffbfef",
					label: "Disc",
                    data : [<?for($month = 1 ; $month <= 12; $month++){ echo $selisih[$month].",";}?>]
                }
            ]

        }

        var bar = new Chart(document.getElementById("bar-chart-js").getContext("2d")).Bar(barChartData,{
			tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>kb",
			animation: false,
		});
		var legendHolder = document.createElement('div');
		legendHolder.innerHTML = bar.generateLegend();

		document.getElementById('legend').appendChild(legendHolder.firstChild);
		


        
    }


    size(true);

}());

</script>
<? 
unset($aa);
unset($total);
unset($fullfillment);
unset($selisih);
unset($persentase);
?>