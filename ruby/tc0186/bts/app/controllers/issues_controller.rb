class IssuesController < ApplicationController
  # GET /issues
  # GET /issues.xml
  def index
    @issues = Issue.find(:all)

    respond_to do |format|
      format.html # index.rhtml
      format.xml  { render :xml => @issues.to_xml }
    end
  end

  # GET /issues/1
  # GET /issues/1.xml
  def show
    @issue = Issue.find(params[:id])

    respond_to do |format|
      format.html # show.rhtml
      format.xml  { render :xml => @issue.to_xml }
    end
  end

  # GET /issues/new
  def new
    @issue = Issue.new
  end

  # GET /issues/1;edit
  def edit
    @issue = Issue.find(params[:id])
  end

  # POST /issues
  # POST /issues.xml
  def create
    @issue = Issue.new(params[:issue])

    respond_to do |format|
      if @issue.save
        flash[:notice] = 'Issue was successfully created.'
        format.html { redirect_to issue_url(@issue) }
        format.xml  { head :created, :location => issue_url(@issue) }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @issue.errors.to_xml }
      end
    end
  end

  # PUT /issues/1
  # PUT /issues/1.xml
  def update
    @issue = Issue.find(params[:id])

    respond_to do |format|
      if @issue.update_attributes(params[:issue])
        flash[:notice] = 'Issue was successfully updated.'
        format.html { redirect_to issue_url(@issue) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @issue.errors.to_xml }
      end
    end
  end

  # DELETE /issues/1
  # DELETE /issues/1.xml
  def destroy
    @issue = Issue.find(params[:id])
    @issue.destroy

    respond_to do |format|
      format.html { redirect_to issues_url }
      format.xml  { head :ok }
    end
  end
end
