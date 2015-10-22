require File.dirname(__FILE__) + '/../../test_helper'
require 'admin/issues_controller'

# Re-raise errors caught by the controller.
class Admin::IssuesController; def rescue_action(e) raise e end; end

class Admin::IssuesControllerTest < Test::Unit::TestCase
  def setup
    @controller = Admin::IssuesController.new
    @request    = ActionController::TestRequest.new
    @response   = ActionController::TestResponse.new
  end

  # Replace this with your real tests.
  def test_truth
    assert true
  end
end
