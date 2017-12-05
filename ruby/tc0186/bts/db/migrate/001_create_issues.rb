class CreateIssues < ActiveRecord::Migration
  def self.up
    create_table :issues do |t|
	  t.column :title,			:string
	  t.column :descr,			:text
	  t.column :assigned_to,	:integer
	  t.column :opened_by,		:integer
	  t.column :open_date,		:timestamp
	  t.column :due_date,		:timestamp
	  t.column :priority,		:string
	  t.column :status,			:string
	  t.column :status_date,	:timestamp
    end
  end

  def self.down
    drop_table :issues
  end
end
