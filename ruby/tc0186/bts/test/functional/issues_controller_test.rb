require File.dirname(__FILE__) + '/../test_helper'
require 'issues_controller'

# Re-raise errors caught by the controller.
class IssuesController; def rescue_action(e) raise e end; end

class IssuesControllerTest < Test::Unit::TestCase
  fixtures :issues

  def setup
    @controller = IssuesController.new
    @request    = ActionController::TestRequest.new
    @response   = ActionController::TestResponse.new
  end

  def test_should_get_index
    get :index
    assert_response :success
    assert assigns(:issues)
  end

  def test_should_get_new
    get :new
    assert_response :success
  end
  
  def test_should_create_issue
    old_count = Issue.count
    post :create, :issue => { }
    assert_equal old_count+1, Issue.count
    
    assert_redirected_to issue_path(assigns(:issue))
  end

  def test_should_show_issue
    get :show, :id => 1
    assert_response :success
  end

  def test_should_get_edit
    get :edit, :id => 1
    assert_response :success
  end
  
  def test_should_update_issue
    put :update, :id => 1, :issue => { }
    assert_redirected_to issue_path(assigns(:issue))
  end
  
  def test_should_destroy_issue
    old_count = Issue.count
    delete :destroy, :id => 1
    assert_equal old_count-1, Issue.count
    
    assert_redirected_to issues_path
  end
end
