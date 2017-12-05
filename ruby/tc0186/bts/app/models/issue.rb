class Issue < ActiveRecord::Base
	has_and_belongs_to_many :tags
	has_many :comments
	
	PRIORITIES = [
		#  Displayed    stored in db
		[ "Low",        "Low" ],
		[ "Medium",		"Medium" ],
		[ "High",		"High" ]
	]

	STATUS_CODES = [
		#  Displayed    	stored in db
		[ "New",        	"New" ],
		[ "Open",			"Open" ],
		[ "In Progress",	"In Progress" ],
		[ "Closed",			"Closed" ]
	]



end
