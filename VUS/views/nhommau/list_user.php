				<h3>Danh sách thành viên đã đăng ký</h3>
			<table class="table" id="table">
				<thead>
					<tr>
						<th>STT</th>
						<th>Họ và tên</th>
						<th>SĐT</th>
						<th>Nhóm máu</th>
					</tr>
				</thead>
				<tbody>
						<?php 								
							$rs=$this->db->get("baiviet_nhommau")->result();
							foreach($rs as $key=>$value){
								?>
									<tr>
										<td>
										<?php echo $key+1; ?>
										</td>									
										<td>
										<?php echo $value->name ?>
										</td>
										<td>
										<?php echo ($value->phone).""; ?>
										</td>
										<td>
										<?php echo $value->typeblood ?>
										</td>		
										<td>
										<a href="<?php echo base_url(); ?>Nhommau/list_user/<?php echo $value->id ?>"><?php echo $value->active ?></a>
										<a href="<?php echo base_url(); ?>Nhommau/delete_uset/<?php echo $value->id ?>">Delete</a>
										</td>																														
									</tr>                                
								<?php                                 
							}
						?>

				  
				</tbody>
			</table>	