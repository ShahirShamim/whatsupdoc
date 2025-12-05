const Input = ({ label, type = "text", ...props }) => {
    return (
        <div className="mb-5">
            {label && <label className="block text-gray-700 text-sm font-medium mb-1.5">{label}</label>}
            <input
                type={type}
                className="w-full px-4 py-2.5 rounded-md bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-gray-900 transition-all duration-200 shadow-sm"
                {...props}
            />
        </div>
    );
};
export default Input;
