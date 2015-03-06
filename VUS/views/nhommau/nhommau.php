<div class="container-fluid">
    <section class="container">
    <form action="<?php echo base_url(); ?>Nhommau/do_save" method="post">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Đăng ký thông tin nhóm máu</h3>
				
				<div class="form-group col-lg-12">
					<label>Họ và tên</label>
					<input type="" name="name" class="form-control" id="" value="">
				</div>				
				<div class="form-group col-lg-6">
					<label>Số  điện thoại</label>
					<input type="text" name="sdt" class="form-control" id="" value="">
				</div>					
				<div class="form-group col-lg-6">
					<label>Nhóm máu</label>
					<input type="text" name="type_blood" class="form-control" id="" value="">
				</div>	
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
								$this->db->where("active",1);
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
										<?php echo substr($value->phone, 0,7)."xxx"; ?>
										</td>
										<td>
										<?php echo $value->typeblood ?>
										</td>																				
									</tr>                                
								<?php                                 
							}
						?>

				  
				</tbody>
			</table>				
			</div>
		
			<div class="col-md-6">
				<h3 class="dark-grey">Ngân hàng máu 4T</h3>
				<p>

Tin khẩn: mẹ bạn Huy bạn của Hợp (kuembmt) đang trong cơn nguy kịch cần gấp máu để phẩu thuật nhưng do gia đình không có điều kiện nên bênh viện cần người để đổi máu, các bạn nào ở SG tình nguyện hiến máu giúp mẹ bạn ấy với ạ. Đang cần rất gấp. Mỗi người 1 ít máu cũng có thể đổi được lượng máu đủ để cứu sống 1 mạng người. Mong các bạn chia sẻ để gia đình bạn Huy được đón Tết sum vầy.....
<br><br>
Cần khoảng 4-6 người hiến máu, hiện đang chờ kết quả xét nghiệm. 
<br>
 Trong ngày hnay sẽ có kqua và đến sáng mai mới tiến hành phẩu thuật. 
Bạn nào có thể hiến máu thì để lại thông tin và nhóm máu, có kết quả trùng mình sẽ liên hệ để sáng mai 11/02/2015 lên hiến nha.

<br><br>
Địa chỉ: bệnh viện tim ở Thành Thái<br>
Liên hệ: - HUY : 0935225331<br>
- Hợp: 0984421177<br>
				</p>
				
				
				<button type="submit" class="btn btn-primary">Đăng ký</button>
								
			</div>
		</div>
	</form>		
	</section>
</div>