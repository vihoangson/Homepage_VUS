		<?php
		$this->db->where("align_title",$this->uri->segment(3));
		$return=$this->db->get("baiviet")->result();
		$id= $return[0]->id;
		$this->db->where("id",$id);
		$this->db->order_by("cm_id","DESC");
		$rs=$this->db->get("baiviet_comment")->result();
		//$rs=$this->db->query("select * from baiviet_comment where id=".$id." order by id ")->result();		
		foreach ($rs as $key => $value) {
			?>
			<div class="qa-message-list" id="wallmessages">
							<div class="message-item" id="m16">
							<div class="message-inner">
								<div class="message-head clearfix">
									<div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"></a></div>
									<div class="user-detail">
										<h5 class="handle">Oleg Kolesnichenko</h5>
										<div class="post-meta">
											<div class="asker-meta">
												<span class="qa-message-what"></span>
												<span class="qa-message-when">
													<span class="qa-message-when-data">Jan 21</span>
												</span>
												<span class="qa-message-who">
													<span class="qa-message-who-pad">by </span>
													<span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko">Oleg Kolesnichenko</a></span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="qa-message-content">
									<?php echo $value->content;?>
								</div>
							</div>						
							</div>

					</div>		
			<?php
			
		}
		
		?>