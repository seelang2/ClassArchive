# This file is autogenerated. Instead of editing this file, please use the
# migrations feature of ActiveRecord to incrementally modify your database, and
# then regenerate this schema definition.

ActiveRecord::Schema.define(:version => 5) do

  create_table "comments", :force => true do |t|
    t.column "issue_id",     :integer
    t.column "user_id",      :integer
    t.column "entry_date",   :datetime
    t.column "comment_text", :text
  end

  create_table "issues", :force => true do |t|
    t.column "title",       :string
    t.column "descr",       :text
    t.column "assigned_to", :integer
    t.column "opened_by",   :integer
    t.column "open_date",   :datetime
    t.column "due_date",    :datetime
    t.column "priority",    :string
    t.column "status",      :string
    t.column "status_date", :datetime
  end

  create_table "issues_tags", :force => true do |t|
    t.column "issue_id", :integer
    t.column "tag_id",   :integer
  end

  create_table "tags", :force => true do |t|
    t.column "name", :string
  end

  create_table "users", :force => true do |t|
    t.column "email",    :string
    t.column "name",     :string
    t.column "password", :string
  end

end
