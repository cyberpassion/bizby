import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { useEffect, useState } from 'react';

function CustomSelect({ id, placeholder, module, dataKey }) {
    const [options, setOptions] = useState([]);
    const [selectedValue, setSelectedValue] = useState('');

    useEffect(() => {
        fetch(`http://bizby.test/api/v1/${module}/options/${dataKey}`)
            .then((response) => response.json())
            .then((res) => {
                // ✅ The API returns: { success: true, data: [ {label, value}, ... ] }
                if (res.success && Array.isArray(res.data)) {
                    setOptions(res.data);
                }
            })
            .catch((error) => {
                console.error('Error fetching select options:', error);
            });
    }, []);

    return (
        <Select onValueChange={setSelectedValue}>
            <SelectTrigger id={id}>
                <SelectValue placeholder={placeholder || 'Select option'} />
            </SelectTrigger>
            <SelectContent>
                {options.map((item) => (
                    <SelectItem key={item.value} value={item.value}>
                        {item.label}
                    </SelectItem>
                ))}
            </SelectContent>
        </Select>
    );
}

export { CustomSelect };
