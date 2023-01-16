require File.dirname(__FILE__) + '/../test_helper'
require 'weather_demo_controller'

# Re-raise errors caught by the controller.
class WeatherDemoController; def rescue_action(e) raise e end; end

class WeatherDemoControllerTest < Test::Unit::TestCase
  def setup
    @controller = WeatherDemoController.new
    @request    = ActionController::TestRequest.new
    @response   = ActionController::TestResponse.new
  end

  # Replace this with your real tests.
  def test_truth
    assert true
  end
end
