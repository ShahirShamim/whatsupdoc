import { useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { useNavigate, Link } from 'react-router-dom';
import Input from '../components/Input';
import Button from '../components/Button';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const { login } = useAuth();
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        const res = await login(email, password);
        if (res.success) {
            navigate('/dashboard');
        } else {
            setError(res.error);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50 px-4">
            <div className="w-full max-w-sm">
                <div className="text-center mb-10">
                    <h1 className="text-2xl font-bold tracking-tight text-gray-900 mb-2">Sign in to your account</h1>
                    <p className="text-sm text-gray-500">Welcome back to WhatsUpDoc</p>
                </div>

                <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                    {error && <div className="bg-red-50 text-red-600 p-3 rounded-md mb-6 text-sm border border-red-100">{error}</div>}

                    <form onSubmit={handleSubmit}>
                        <Input label="Email address" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
                        <Input label="Password" type="password" value={password} onChange={(e) => setPassword(e.target.value)} required />

                        <Button type="submit" className="mt-2">Sign In</Button>
                    </form>
                </div>

                <p className="text-center text-gray-500 mt-8 text-sm">
                    New here? <Link to="/signup" className="text-gray-900 font-medium hover:underline">Create an account</Link>
                </p>
            </div>
        </div>
    );
};
export default Login;
