class StoreController < ApplicationController

  def index
    @products = Product.find_products_for_sale
	@cart = find_cart
  end
  
  def add_to_cart
    begin
	  product = Product.find(params[:id])
	rescue ActiveRecord::RecordNotFound
	  logger.error("Attempt to access invalid product #{params[:id]}")
	  redirect_to_index("Invalid Product")
	else
	  @cart = find_cart
	  @current_item = @cart.add_product(product)
	  redirect_to_index unless request.xhr?
	end
  end
  
  def remove_from_cart
    product = params[:id]
    @cart = find_cart
	@current_item = @cart.remove_product(product)
	redirect_to_index
  end
  
  def view_cart
    @cart = find_cart
#	session[:cart_viewed] ||= 0
#	session[:cart_viewed] +=1 if flash[:cart_called]

#	flash[:cart_called] = session[:cart_viewed]
	
  end
  
  def empty_cart
    session[:cart] = nil
	session[:cart_viewed] = nil
	redirect_to_index unless request.xhr?
  end
  
  def checkout
    @cart = find_cart
	if @cart.items.empty?
	  redirect_to_index("Your cart is empty")
	else
	  @order = Order.new
	end
  end
  
  def save_order
    @cart = find_cart
	@order = Order.new(params[:order])
	@order.add_line_items_from_cart(@cart)
	if @order.save
	  session[:cart] = nil
	  redirect_to_index("Thank you for your order")
	else
	  render :action => :checkout
	end
  end

private
  def find_cart
	session[:cart] ||= Cart.new
  end
  
  def redirect_to_index(msg = nil)
 	flash[:notice] = msg if msg
	redirect_to :action => :index
  end
   
end
