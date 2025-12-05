import { useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { useNavigate, Link } from 'react-router-dom';
import Input from '../components/Input';
import Button from '../components/Button';

const Signup = () => {
    const [formData, setFormData] = useState({
        name: '', email: '', password: '', role: 'patient', phone: '', city: '', bio: '', address: ''
    });
    const [error, setError] = useState('');
    const { register } = useAuth();
    const navigate = useNavigate();

    const handleChange = (e) => setFormData({ ...formData, [e.target.name]: e.target.value });

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        const res = await register(formData);
        if (res.success) {
            alert('Registration successful! Please login.');
            navigate('/login');
        } else {
            setError(res.error);
        }
    };

    return (
        <div className="min-h-screen py-20 flex items-center justify-center bg-gray-50 px-4">
            <div className="w-full max-w-md">
                <div className="text-center mb-10">
                    <h1 className="text-2xl font-bold tracking-tight text-gray-900 mb-2">Create your account</h1>
                    <p className="text-sm text-gray-500">Join thousands of patients and doctors</p>
                </div>

                <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                    {error && <div className="bg-red-50 text-red-600 p-3 rounded-md mb-6 text-sm border border-red-100">{error}</div>}

                    <form onSubmit={handleSubmit} className="space-y-4">
                        <Input label="Full Name" name="name" value={formData.name} onChange={handleChange} required />
                        <Input label="Email" type="email" name="email" value={formData.email} onChange={handleChange} required />
                        <Input label="Password" type="password" name="password" value={formData.password} onChange={handleChange} required />

                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-medium mb-3">I am a...</label>
                            <div className="flex gap-4">
                                <label className="flex items-center cursor-pointer p-3 border border-gray-200 rounded-lg w-full hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="role" value="patient" checked={formData.role === 'patient'} onChange={handleChange} className="mr-3" />
                                    <span className="text-gray-900 font-medium">Patient</span>
                                </label>
                                <label className="flex items-center cursor-pointer p-3 border border-gray-200 rounded-lg w-full hover:bg-gray-50 transition-colors">
                                    <input type="radio" name="role" value="doctor" checked={formData.role === 'doctor'} onChange={handleChange} className="mr-3" />
                                    <span className="text-gray-900 font-medium">Doctor</span>
                                </label>
                            </div>
                        </div>

                        <Input label="Phone Number" name="phone" value={formData.phone} onChange={handleChange} required />

                        {formData.role === 'doctor' ? (
                            <>
                                <Input label="City" name="city" value={formData.city} onChange={handleChange} required />
                                <div className="mb-5">
                                    <label className="block text-gray-700 text-sm font-medium mb-1.5">Bio</label>
                                    <textarea
                                        name="bio"
                                        value={formData.bio}
                                        onChange={handleChange}
                                        className="w-full px-4 py-2.5 rounded-md bg-white border border-gray-200 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-gray-900 transition-all duration-200 shadow-sm"
                                        rows="3"
                                    />
                                </div>
                            </>
                        ) : (
                            <Input label="Address" name="address" value={formData.address} onChange={handleChange} />
                        )}

                        <Button type="submit" className="mt-6">Create Account</Button>
                    </form>
                </div>

                <p className="text-center text-gray-500 mt-8 text-sm">
                    Already have an account? <Link to="/login" className="text-gray-900 font-medium hover:underline">Sign in</Link>
                </p>
            </div>
        </div>
    );
};
export default Signup;
