class CreateIssuesTags < ActiveRecord::Migration
  def self.up
    create_table :issues_tags do |t|
	  t.column :issue_id,	:integer
	  t.column :tag_id,		:integer
    end
  end

  def self.down
    drop_table :issue_tags
  end
end
