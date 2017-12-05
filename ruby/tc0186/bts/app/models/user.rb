class User < ActiveRecord::Base
	has_many :comments
	
	
	def self.get_userlist
		find(:all, :order => "name")
	end
	
	

end
