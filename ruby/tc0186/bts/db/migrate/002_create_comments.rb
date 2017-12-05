class CreateComments < ActiveRecord::Migration
  def self.up
    create_table :comments do |t|
	  t.column :issue_id,		:integer
	  t.column :user_id,		:integer
	  t.column :entry_date,		:timestamp
	  t.column :comment_text,	:text
    end
  end

  def self.down
    drop_table :comments
  end
end
