class MainController < ApplicationController
  def initialize
  	# used to store all common variables used throughout entire controller
	@userlist = User.find(:all, :order => 'name').map { |u| [u.name, u.id] }
  end
  
  def index
    list
    render :action => 'list'
  end

  # GETs should be safe (see http://www.w3.org/2001/tag/doc/whenToUseGet.html)
  verify :method => :post, :only => [ :destroy, :create, :update ],
         :redirect_to => { :action => :list }

  def list
    @issue_pages, @issues = paginate :issues, :per_page => 10
  end
  
  def test
  	@users = User.get_userlist
  end

  def show
    @issue = Issue.find(params[:id])

#    @comment_pages, @comments = paginate :comments, :per_page => 10

	@comments = @issue.comments

	@tags = @issue.tags
	
	flash[:from] = 'show'
  end

  def new
    @issue = Issue.new
  end

  def create
    @issue = Issue.new(params[:issue])
    if @issue.save
      flash[:notice] = 'Issue was successfully created.'
      redirect_to :action => 'list'
    else
      render :action => 'new'
    end
  end

  def edit
    @issue = Issue.find(params[:id])
  end

  def update
    @issue = Issue.find(params[:id])
    if @issue.update_attributes(params[:issue])
      flash[:notice] = 'Issue was successfully updated.'
      redirect_to :action => 'show', :id => @issue
    else
      render :action => 'edit'
    end
  end

  def destroy
    Issue.find(params[:id]).destroy
    redirect_to :action => 'list'
  end
  
  def add_new_comment
  
  end
  
  def delete_comment
    @target_comment = Comment.find(params[:id])
	@issue_id = @target_comment.issue_id
	@target_comment.destroy
	
    redirect_to :action => 'show', :id => @issue_id
  end
  
  
  
end
