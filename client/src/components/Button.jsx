const Button = ({ children, variant = "primary", className = "", ...props }) => {
    const baseStyles = "w-full font-medium py-2.5 px-4 rounded-md transition-all duration-200 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2";

    const variants = {
        primary: "bg-gray-900 hover:bg-black text-white shadow-sm focus:ring-gray-900",
        secondary: "bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 shadow-sm focus:ring-gray-200",
        danger: "bg-red-50 hover:bg-red-100 text-red-600 border border-red-100",
    };

    return (
        <button className={`${baseStyles} ${variants[variant]} ${className}`} {...props}>
            {children}
        </button>
    );
};
export default Button;
