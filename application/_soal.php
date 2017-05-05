

                            <table class="table table-soal data-table custom-table table-hover">
                            <thead>
                            <tr bgcolor="#dedede">

								<th rowspan='2' style="text-align:center;" width="15%">Aspek</th>
                                <th rowspan='2' style="text-align:center;">Definisi</th>
								<th style="text-align:center;" width="1%">SK</th>
								<th style="text-align:center;" width="1%">K</th>
								<th style="text-align:center;" width="1%">C</th>
								<th style="text-align:center;" width="1%" >B</th>
								<th style="text-align:center;" width="1%" >BS</th>
                                <th rowspan='2' style="text-align:center;" width="30%">Keterangan</th>
                            </tr>
							<tr>
								<th style="text-align:center;" >1</th>
								<th style="text-align:center;" >2</th>
								<th style="text-align:center;" >3</th>
								<th style="text-align:center;" >4</th>
								<th style="text-align:center;" >5</th>
							</tr>
                            </thead>
                            <tbody>
								<?
								$type=1;
								$group_q=mysql_query("select kategori from penilaian where tipe_penilaian='$type' and `status`=1 group by kategori");
								while($group=mysql_fetch_array($group_q)){
								?>
								<tr>
									<td colspan="8"><b><?=$group['kategori']?></b></td>
								</tr>
								<?
									$list_q=mysql_query("select * from penilaian where kategori='".$group['kategori']."' and tipe_penilaian='$type' and `status`='1'");
									while($list=mysql_fetch_array($list_q)){
								?>
								<tr>
									<td style="padding-left:20px;"><?=$list['aspek']?></td>
									<td ><?=$list['definisi']?></td>
									<td align="center"><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="1"></td>
									<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="2"></td>
									<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="3"></td>
									<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="4"></td>
									<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="5"></td>
									<td ><textarea name="keterangan<?=$list['id_penilaian']?>" style="width:100%; height:100%;"></textarea></td>
								</tr>
								<? }}?>
                            </tbody>
                            </table>
							